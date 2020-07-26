@foreach ($imageData as $row)
<div class="col-md-2">
    <div class="card" style="margin-bottom: 10px;">
        <img class="card-img-top" style="height:100px;object-fit: cover;" src="{{ asset($row['image']) }}" alt="{{ $row['title'] }}">
        <div class="card-body">
            <p class="card-title">{{ $row['title'] }}</p>
            <a href="javascript:void(0)" id="{{ $row['id'] }}" class="btn btn-danger remove-image">Remove</a>
        </div>
    </div>
</div>
@endforeach