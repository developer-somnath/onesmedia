@extends('layouts.master')
@section('content')
<div class="app-main__inner">
                       
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-3">
                <div class="card-header">Categories                                        
                </div>
                <div class="card-body">
                <ul class="folder-style">
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span>Adventure</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span>Children</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Comedy</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Compilation</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Country Music</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Detective</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Drama</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Gossip</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Historical</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Holiday</a></li>
                    <li><a href="uploadfile.html"><span><img src="{{ asset('assets/images/folder.png') }}"></span> Sports</a></li>
                </ul>
          
               </div>
            </div>
        </div>
    </div>
   
</div>
@stop
@push('scripts')
@endpush