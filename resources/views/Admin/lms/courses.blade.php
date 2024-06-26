@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">User Courses</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">User Courses</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">L.M.S Courses</h4>
                            <p>
                                Browse through and review courses created by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Course List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's Name</th>
                                            <th>Course Title</th>
                                            <th>Course Category</th>
                                            <th>Enrollment</th>
                                            <th>Published</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Course::latest()->get() as $course)
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{App\Models\User::find($course->user_id)->first_name}} {{App\Models\User::find($course->user_id)->last_name}}
                                            </td>
                                            <td>
                                                {{$course->title}}
                                            </td>
                                            <td>
                                                </i>{{App\Models\Category::find($course->category_id)->name}}
                                            </td>
                                            <td>
                                                <i class="fas fa-user"> {{App\Models\ShopOrder::where('course_id',$course->id)->get()->count()}}
                                            </td>
                                            <td>
                                                <i class="fas fa-play-circle"></i>
                                                @if($course->published == false)
                                                Unpublish
                                                @else
                                                Published
                                                @endif
                                            </td>
                                            <td>
                                                @if($course->approved == false)
                                                <i class="bi bi-eye-slash-fill"></i>
                                                <span class="badge badge-pill badge-soft-danger text-danger font-size-11">Inactive</span>
                                                @else
                                                <i class="bi bi-check2-all"></i>
                                                <span class="badge badge-pill badge-soft-success text-success font-size-11">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$course->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                                        <a href="{{route('courseDetail', Crypt::encrypt($course->id))}}"  class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li>
                                                    @if($course->approved == true)
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend Course">
                                                        <a href="{{route('course.deactivate', $course->id)}}" class="btn btn-sm btn-soft-danger"><i class="bi bi-x-circle"></i></a>
                                                    </li>
                                                    @else
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate Course">
                                                        <a href="{{route('course.activate', $course->id)}}" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
