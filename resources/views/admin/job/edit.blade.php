@extends('layouts.admin.index')

@section('title', 'Edit Job')

@section('content_header', 'Edit Job')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('admin.job.partial.listButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form action="{{url('admin/job', ['id'=>$job->id])}}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <input type="checkbox" name="isPremium" @if($job->is_premium == 1) checked="checked" @endif() id="isPremium"> <label for="isPremium">Premium </label>
                                        @error('isPremium')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="jobTitle">Title <sup class="text-danger">*</sup></label>
                                        <input type="text" name="jobTitle" value="{{ $job->title }}"
                                               placeholder="Enter job title" class="form-control" id="jobTitle">
                                        @error('jobTitle')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="jobCategory">Category <sup class="text-danger">*</sup></label>
                                        <select name="jobCategory" class="form-control">
                                            @if(!empty($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($job->category_id == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('jobCategory')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="jobType">Type of position <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="col-xs-4">
                                    <label for="jobLocationType">Remote or location based? <sup class="text-danger">*</sup></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        @if(!empty(\Config::get('constants.jobTypes'))) 
                                            @foreach(\Config::get('constants.jobTypes') as $key => $value)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="jobType" value="{{ $key }}" @if($job->job_type == $key) checked="checked" @endif>
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                        @error('jobType')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jobLocation" value="office" @if($job->location == 'office') checked="checked" @endif>
                                            Location based (in office)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jobLocation" value="remote_anywhere" @if($job->location == 'remote_anywhere') checked="checked" @endif>
                                            Remote (anywhere)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jobLocation" value="remote_region" @if($job->location == 'remote_region') checked="checked" @endif>
                                            Remote (with regional restrictions)
                                        </label>
                                    </div>
                                    @error('jobLocation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4">
                                    <div class="form-group jobOfficeLocationDiv" @if($job->location == 'office') @else style="display: none;" @endif>
                                        <label for="jobOfficeLocation" class="control-label">Office location *</label>
                                        <input type="text" class="form-control" name="jobOfficeLocation" placeholder="e.g. New York City, NY" @if($job->location == 'office' && $job->location_detail) value="{{ $job->location_detail }}" @endif>
                                        @error('jobOfficeLocation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4">
                                    <div class="form-group jobRegionalRestrictionDiv" @if($job->location == 'remote_region') @else style="display: none;" @endif>
                                        <label for="jobRegionalRestriction" class="control-label">Regional Restrictions *</label>
                                        <input type="text" class="form-control" name="jobRegionalRestriction" placeholder="e.g. Must live in US, or Must be in GMT +/-2" @if($job->location == 'remote_region' && $job->location_detail) value="{{ $job->location_detail }}" @endif>
                                        @error('jobRegionalRestriction')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="jobType">Salary information</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control" name="jobSalaryCurrency">
                                        @if(!empty(\Config::get('constants.jobSalaryCurrency'))) 
                                            @foreach(\Config::get('constants.jobSalaryCurrency') as $key => $value)
                                                <option value="{{ $key }}" @if(isset($job->salary->currency_type) && $job->salary->currency_type == $key) selected="selected" @endif>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobSalaryCurrency')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="jobSalaryFrom" placeholder="From" @if(isset($job->salary->range_from) && $job->salary->range_from) value="{{ $job->salary->range_from }}" @endif>
                                    @error('jobSalaryFrom')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="jobSalaryTo" placeholder="To" @if(isset($job->salary->range_to) && $job->salary->range_to) value="{{ $job->salary->range_to }}" @endif>
                                    @error('jobSalaryTo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="jobSalaryType">
                                        @if(!empty(\Config::get('constants.jobSalaryType'))) 
                                            @foreach(\Config::get('constants.jobSalaryType') as $key => $value)
                                                <option value="{{ $key }}" @if(isset($job->salary->rate) && $job->salary->rate == $key) selected="selected" @endif>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobSalaryType')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="jobApplyLink">How to apply <sup class="text-danger">*</sup></label>
                                        <input type="text" name="jobApplyLink" value="{{ $job->apply_link }}"
                                               class="form-control" id="jobApplyLink" placeholder="e.g. https://www.company.com/careers/apply" @if($job->apply_link) value="{{ $job->apply_link }}" @endif>
                                        @error('jobApplyLink')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="jobDescription" class="control-label">Job description <sup class="text-danger">*</sup></label>
                                    <textarea class="jobDescriptionEditor" name="jobDescription">@if($job->description) {{ $job->description }} @endif</textarea>
                                    @error('jobDescription')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Company info -->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyName">Company name <sup class="text-danger">*</sup></label>
                                        <input type="text" name="companyName" value="{{ $job->company->name }}"
                                               placeholder="e.g. Company Ltd." class="form-control" id="companyName">
                                        @error('companyName')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyStatement">Company statement </label>
                                        <input type="text" name="companyStatement" value="{{ $job->company->statement }}"
                                               placeholder="e.g. It's our mission to fulfill our vision" class="form-control" id="companyStatement">
                                        @error('companyStatement')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyLogo">Company logo </label>
                                        <input type="file" name="companyLogo" class="form-control" id="companyLogo">
                                        @error('companyLogo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyEmail">Company Email <sup class="text-danger">*</sup></label>
                                        <input type="email" name="companyEmail" value="{{ $job->company->email }}"
                                               placeholder="e.g. receipts@company.com" class="form-control" id="companyEmail">
                                        @error('companyEmail')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyWebsite">Website address </label>
                                        <input type="text" name="companyWebsite" value="{{ $job->company->website }}"
                                               placeholder="e.g. https://www.company.com" class="form-control" id="companyWebsite">
                                        @error('companyWebsite')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyTwitter">Twitter handle</label>
                                        <input type="text" name="companyTwitter" value="{{ $job->company->twitter }}"
                                               placeholder="e.g. @company" class="form-control" id="companyTwitter">
                                        @error('companyTwitter')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="companyLocation">Company location </label>
                                        <input type="text" name="companyLocation" value="{{ $job->company->location }}"
                                               placeholder="e.g. New York City, NY" class="form-control" id="companyLocation">
                                        @error('companyLocation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="companyDescription" class="control-label">Company description</label>
                                    <textarea class="companyDescriptionEditor" name="companyDescription">@if($job->company->description) {{ $job->company->description }} @endif</textarea>
                                    @error('companyDescription')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-sm btn-success"> Submit
                                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.job.partial.common-script')                                    
@endsection
