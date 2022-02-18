@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Page Control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/data_seo" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Site Name</label>
                            <textarea class="form-control" name="site_name" id="site_name" rows="3">{{@$seo->site_name}}</textarea>
                            <div class="text-muted text-white">Gunkan Site Name untuk disini</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{@$seo->description}}</textarea>
                            <div class="text-muted text-white">Gunkan description untuk disini</div>
                        </div>
                        <div class="form-group">
                            <label for="type">type</label>
                            <textarea class="form-control" name="type" id="type" rows="3">{{@$seo->type}}</textarea>
                            <div class="text-muted text-white">Gunkan Site Name untuk disini</div>
                        </div>
                        <div class="form-group">
                            <label for="head">Head</label>
                            <textarea class="form-control" name="head" id="head" rows="3">{{@$seo->head}}</textarea>
                            <div class="text-muted text-white">Gunkan HTML untuk disini</div>
                        </div>
                        <div class="form-group">
                          <label for="iklan">Iklan</label>
                          <textarea class="form-control" name="iklan" id="iklan_popup" rows="3">{{@$seo->iklan}}</textarea>
                            <div class="text-muted text-white">Gunkan URL untuk disini</div>
                        </div>
                        <div class="form-group">
                          <label for="css">Css</label>
                          <textarea class="form-control" name="css" id="css" rows="3">{{@$seo->css}}</textarea>
                           <div class="text-muted text-white">Gunkan style untuk disini</div>
                        </div>
                        <div class="form-group">
                          <label for="script">Java Script</label>
                          <textarea class="form-control" name="script" id="script" rows="3">{{@$seo->script}}</textarea>
                          <div class="text-muted text-white">Gunkan script untuk disini</div>
                        </div>
                        <div class="form-group">
                          <label for="file_import">Sitemap</label>
                          <input type="file" class="form-control" name="file_import" id="file_import" >
                          <div class="text-muted text-white">Sitting Sitemap</div>
                        </div>
                        
                        <div class="text-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
