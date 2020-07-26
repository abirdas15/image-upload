<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function uploadImage(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:png|max:5120',
            'title' => 'required'
        ]);
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath, $fileName);
        $imageUrl = $destinationPath . '/' . $fileName;

        $dataArry = array(
            'id'    => rand(10,1000),
            'image' => $imageUrl,
            'title' => $request->title,
            'date'  => date('Y-m-d h:i:s')
        );
        $filepath = '';
        $filepath = './database.json';
        if (file_exists('./database.json')) {
            $data = file_get_contents('./database.json');
            $json_arr = json_decode($data, true);
        }
        $json_arr[] =  $dataArry;
        file_put_contents('./database.json', json_encode($json_arr));
        return 1;
    }
    function fetchImage(Request $request)
    {
        $filepath = './database.json';
        $imageFile = file_get_contents($filepath);
        $images = json_decode($imageFile);
        $imageData = array();
        foreach ($images as $row) {
            $image = (array) ($row);
            $imageData[] = array(
                'id' => $image['id'],
                'title' => $image['title'],
                'image' => $image['image'],
                'created_at' => $image['date'],
            );
        }
        $this->array_sort_by_column($imageData, 'created_at');
        if ($request->keywords) {
            $filterBy = $request->keywords;
            $imageData = array_filter($imageData, function ($var) use ($filterBy) {
                return ($var['title'] == $filterBy);
            });
        }
        return view('image-preview', compact('imageData'));
    }
    private function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }
        return array_multisort($sort_col, $dir, $arr);
    }
    public function deleteImage(Request $request)
    {
        $data = file_get_contents('./database.json');
        $json_arr = json_decode($data, true);
        $arr_index = array();
        foreach ($json_arr as $key => $value) {
            if ($value['id'] == $request->id) {
                $arr_index[] = $key;
            }
        }
        //dd($arr_index);
        foreach ($arr_index as $i) {
            $filePatth = './'.$json_arr[$i]['image'];
            unset($json_arr[$i]);
            if (file_exists($filePatth)) {
                unlink($filePatth);
            }
        }
        $json_arr = array_values($json_arr);
        file_put_contents('./database.json', json_encode($json_arr));
        return 1;
    }
}
