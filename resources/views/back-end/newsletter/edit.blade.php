@extends('back-end.admin-layout')

@section('content')
    <div>
        <form  method="post" action="{{ route('newsletter.update', $newsletter->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row bg-white my-4 mx-1 p-3 shadow-sm">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input  name="title" class="form-control" type="text"  placeholder="Title" value="{{ $newsletter->title }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select  name="category_id" class="form-control" id="exampleFormControlSelect1">
                            <option disabled selected>Select</option>
                            <option value="1">Home</option>
                            <option value="2">Medicine</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type</label>
                        <select name="type" class="form-control" id="exampleFormControlSelect1">
                            <option disabled selected>Select</option>
                            <option value="daily" {{$newsletter->type == 'daily' ? 'selected' : ''}}>Daily</option>
                            <option value="weekly" {{$newsletter->type == 'weekly' ? 'selected' : ''}}>Weekly</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publishing Date</label>
                        <input  name="publishing_date"  type="datetime-local" class="form-control" value="{{ $newsletter->publishing_date    }}">
                    </div>
                </div>

                <div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Thumbnail Image (Jpg, Png. Image will be resized automatically )</label>
                            <input name="thumbnail" type="file" class="form-control-file">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea name="newsletter_content" class="form-control" rows="10">{{json_decode($newsletter->newsletter_content)->data}}</textarea>
                    </div>
                </div>


                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection