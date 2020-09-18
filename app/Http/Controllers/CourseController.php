<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
class CourseController extends Controller
{

    public function __construct(){
        $this->authorizeResource(Course::class, 'course');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::all();
        return view('admin.courses.create',compact('course','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasfile('imglink')){
            $slug = Str::slug("$request->name",'-');
            $data['slug'] = $slug;
            $extension = $request->imglink->getClientOriginalExtension();
            $data['imglink']="$slug.{$extension}";
            Course::create($data);
            $request->imglink->storeAs('public/img',$data['imglink']);
        }
        else{
            unset($data['imglink']);
        }
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $categories = Category::all();
        $linkvideo= Course::urlVideo($course->video);
        return view('admin.courses.show',compact('course','categories','linkvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit',compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request,Course $course)
    {
        $data = $request->all();
        Storage::delete('/public/img/' .$course->imglink);
        if($request->hasfile('imglink')){
            $slug = Str::slug("$request->name",'-');
            $data['slug'] = $slug;
            $extension = $request->imglink->getClientOriginalExtension();
            $imgname = "$slug.{$extension}";
            $data['imglink']=$imgname;
            $request->imglink->storeAs('public/img',$imgname);
        }
        else{
            unset($data['imglink']);
        }
        $course->update($data);
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        Storage::delete('/public/img/' .$course->imglink);
        return redirect()->route('courses.index')->with('success',true);
    }
}
