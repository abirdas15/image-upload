@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Your Image</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Upload Image
                            </button>
                        </div>
                        <div class="col-md-10">
                            <input type="text" placeholder="Search" name="" id="search-image" class="form-control">
                        </div>
                    </div><hr>
                    <div class="row" id="image-preview">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="image-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" name="image" class="dropify" data-height="250" data-width="200"><hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="imageTitle" class="col-sm-2 col-form-label">Image Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="imageTitle" placeholder="Image Title">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 offset-md-5">
                            <button type="submit" class="btn btn-primary" id="upload-btn">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    hr {
        border-top:2px dotted #000;
        /*Rest of stuff here*/
    }
</style>
@endsection
@section('script')
<script>
    $('.dropify').dropify();
    $(document).ready(function(){
        fetchImage();
    });
    $(document).on('click', '#upload-btn', function(event) {
        event.preventDefault();
        let form = $('#image-form')[0];
        let form_data = new FormData(form);
        $.ajax({
            type: 'POST',
            url: "{{ route('image.upload') }}",
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            success:function(response){
                if (response == 1) {
                    toastr.success('Successfully upload image.', 'Success');
                    $('.dropify-clear').trigger('click');
                    $('#imageTitle').val('');
                    fetchImage();
                } else {
                    toastr.warning('Image upload fail', 'Warning');
                }
            },
            error: function (request, status, error) {
                if (request.responseJSON.errors.image) {
                    toastr.warning(request.responseJSON.errors.image[0], 'Warning');
                } else if (request.responseJSON.errors.title) {
                    toastr.warning(request.responseJSON.errors.title[0], 'Warning');
                }
            }
        })
    });
    function fetchImage(val='') {
        $.ajax({
            type: 'GET',
            url: "{{ route('fetch.image') }}",
            data:{
                "keywords": val
            },
            success:function(response){
                $("#image-preview").html(response);
            }
        })
    }
    $(document).on('keyup', '#search-image', function(){
        let val = $(this).val();
        fetchImage(val);
    });
    $(document).on('click', '.remove-image', function () {
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
                let id = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('delete.image') }}",
                    data:{
                        "id": id
                    },
                    success:function(response){
                        if (response == 1) {
                            fetchImage();
                        }
                    }
                })
            } else {
            
            }
            });
        });
</script>
@endsection