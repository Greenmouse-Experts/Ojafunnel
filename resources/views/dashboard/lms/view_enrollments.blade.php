@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
  <div class="page-content">
    <!-- container-fluid -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
            <h4 class="mb-sm-0 font-size-18">Enrollments</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                <li class="breadcrumb-item active">Enrollments</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- start page title -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card account-head">
            <div class="row">
              <div class="col-md-9">
                <div class="py-2">
                  <h4 class="font-500">Enrollments</h4>
                  <p>
                    All your students that enrolled in your course
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- shop data information-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4">Enrollments</h4>
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                  <thead class="tread">
                    <tr>
                      <th>S/N</th>
                      <th>Student</th>
                      <th>Course</th>
                      <th>Order No</th>
                      <th>Payment Method</th>
                      <th>Amount</th>
                      <th>Purchase Date</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach (\App\Models\ShopOrder::where('shop_id', $shop->id)->get() as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#view-student-{{$item->id}}">View Student</a></td>
                                <div class="modal fade" id="view-student-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 45%">
                                        <div class="modal-content pb-3">

                                            <div class="modal-header border-bottom-0">
                                                <h4 class="card-title mb-4">Student Details</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="Editt">
                                                    <div>
                                                        <div class="Editt">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Name: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->name}}</label>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Email: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->email}}</label>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Phone Number: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->phone_no}}</label>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Address: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->address}}</label>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">State: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->state}}</label>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="Name">Country: {{\App\Models\Enrollment::where('order_no', $item->order_no)->first()->country}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <td>
                              <a href="{{route('user.create.course', Auth::user()->username)}}">View Course</a>
                            </td>
                            <td>
                                {{$item->order_no}}
                            </td>
                            <td>
                                {{$item->payment_method}}
                            </td>
                            <td>
                                {{number_format($item->amount, 2)}}
                            </td>
                            <td>
                                {{$item->created_at->toDayDateTimeString()}}
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
      <!-- end page title -->
    </div>
  </div>
  <script>
    $(document).ready(function(){

      $("#shopName").keyup(function(){
        if(document.getElementById('shopName').value.match(/\s/g)){
            document.getElementById('shopName').value=document.getElementById('shopName').value.replace(/\s/g,'');
        }
        $("#myInput").val('http://shop.ojafunnel.test/'+$("#shopName").val());
      });
    });
</script>
<script>
    function myCopyFunction() {
        // Get the text field
        var copyText = document.getElementById("myInput");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        //alert("Copied the text: " + copyText.value);
    }
</script>
  <!-- End Page-content -->
</div>

<style>
    .container2 {
      display: inline;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container2 input[type=radio] {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .amber {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #00387d;
      border-radius: 50%;
    }

    .lime {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #00ff00;
      border-radius: 50%;
    }

    .teal {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #008080;
      border-radius: 50%;
    }
    .blue {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #010199;
      border-radius: 50%;
    }

    .indigo {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #4b0082;
      border-radius: 50%;
    }



    /* On mouse-over, add a grey background color */
    .container2:hover input ~ .rdio {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container2 input:checked ~ .rdio {
      background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .rdio:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container2 input:checked ~ .rdio:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container2 .rdio:after {
         top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
</style>

@endsection
