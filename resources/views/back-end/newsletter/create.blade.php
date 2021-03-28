@extends('back-end.admin-layout')

@section('content')
    <div>
        <form  method="post" action="{{ route('newsletter.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row bg-white my-4 mx-1 p-3 shadow-sm">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input  name="title" class="form-control" type="text"  placeholder="Title" value="{{ old('title') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select  name="category_id" class="form-control" id="exampleFormControlSelect1" required>
                            <option disabled selected>Select</option>

                            @foreach($newsletterCategories as $newsletterCategory)
                                <option value="{{$newsletterCategory->id}}">{{$newsletterCategory->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publishing Date</label>
                        <input  name="publishing_date"  type="date" class="form-control" value="{{ old('publishing_date') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Thumbnail Image (Jpg, Png. Image will be resized to 300*200 automatically )</label>
                        <input name="thumbnail" type="file" class="form-control-file" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea name="newsletter_content" class="form-control" rows="10" required>
                            {{old('newsletter_content')}}
                        </textarea>
                    </div>
                </div>


                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection