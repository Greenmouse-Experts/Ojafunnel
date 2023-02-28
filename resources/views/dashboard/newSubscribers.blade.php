@extends('layouts.dashboard-email-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">New subscriber</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">New subscriber</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">New subscriber</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card all-create account-head">
                        <nav aria-label="Page navigation example normal float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{route('user.list.performance', Auth::user()->username)}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    @if(Session::has('alert-success'))
                        <p class="alert alert-success">{{ Session::get('alert-success') }}</p>
                    @endif
                    <div class="Edit">
                        <form action="{{ route('user.new.subscribers.post', ["username" => Auth::user()->username, "uid" => $list->uid]) }}" method="POST" class="form-validate-jquery">
                            {{ csrf_field() }}
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b class="mb-sm-0 font-size-15">Create New Subscriber</b>
                                    </p>
                                    @foreach ($list->getFields as $field)
                                        @if ($field->visible || !isset($is_page))
                                            @if ($field->tag != 'EMAIL')
                                                @if ($field->type == "text")
                                                    @include('helpers.form_control', ['type' => $field->type, 'name' => $field->tag, 'label' => $field->label, 'placeholder' => 'Enter your '.$field->label, 'class' => 'mb-4', 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "number")
                                                    @include('helpers.form_control mb-4', ['type' => 'number', 'name' => $field->tag, 'placeholder' => 'Enter your '.$field->label, 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "textarea")
                                                    @include('helpers.form_control', ['type' => 'textarea', 'name' => $field->tag, 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "dropdown")
                                                    @include('helpers.form_control', ['type' => 'select', 'name' => $field->tag, 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "multiselect")
                                                    @include('helpers.form_control', ['multiple' => true, 'type' => 'select', 'name' => $field->tag . "[]", 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "checkbox")
                                                    @include('helpers.form_control', ['multiple' => true, 'type' => 'checkboxes', 'name' => $field->tag . "[]", 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "radio")
                                                    @include('helpers.form_control', ['multiple' => true, 'type' => 'radio', 'name' => $field->tag, 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "date")
                                                    @include('helpers.form_control', ['multiple' => true, 'type' => 'date', 'name' => $field->tag . "[]", 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @elseif ($field->type == "datetime")
                                                    @include('helpers.form_control', ['multiple' => true, 'type' => 'datetime', 'name' => $field->tag . "[]", 'label' => $field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'options' => $field->getSelectOptions(), 'rules' => $list->getFieldRules()])
                                                @endif
                                            @else
                                                @include('helpers.form_control', ['type' => $field->type, 'name' => $field->tag, 'label' => $field->label, 'class' => 'mb-4', 'placeholder' => 'Enter your '.$field->label, 'value' => (isset($values[$field->tag]) ? $values[$field->tag] : $field->default_value), 'rules' => $list->getFieldRules()])
                                            @endif
                                        @endif
                                    @endforeach
                                    {{-- <div class="col-lg-12">
                                        <label>Email <span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="email" placeholder="Enter Your Email" name="name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>First Name<span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Your First name" name="name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Last Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Your Last Name" name="name" class="input" required>
                                            </div>
                                        </div>
                                    </div> --}}
                                    @if (\App\Models\Setting::get('import_subscribers_commitment'))
                                        <hr>
                                        <div class="mt-5">
                                            @include('helpers.form_control', [
                                                'type' => 'checkbox2',
                                                'class' => 'policy_commitment mb-10 required',
                                                'name' => 'policy_commitment',
                                                'value' => 'no',
                                                'required' => true,
                                                'label' => \App\Models\Setting::get('import_subscribers_commitment'),
                                                'options' => ['no','yes'],
                                                'rules' => []
                                            ])
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info">{{ trans('messages.save') }}</button>
                                            <a href="{{route('user.list.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid]) }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
