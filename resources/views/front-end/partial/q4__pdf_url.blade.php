@if($item->q4__pdf_url != '#')
    @if(auth()->user()->isSubscriber())
        <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q4__pdf_url }}" type="button" class="btn btn-outline-primary">{{ $item->q4__pdf_url_file_name != null ? $item->q4__pdf_url_file_name : 'PDF' }}</a></td>
    @else
        @if(auth()->user()->canDownload())
            <td>
                <form action="{{ route('download.store' )}}" method="post" style="display: inline;">
                    @csrf
                    <input name="file_path" type="hidden" value="{{ env('S3_URL') }}{{ $item->q4__pdf_url }}">
                    <button type="submit" class="btn btn-outline-primary">{{ $item->q4__pdf_url_file_name != null ? $item->q4__pdf_url_file_name : 'PDF' }}</button>
                </form>
            </td>
        @else
            <td><a href="/#pricing" class="btn btn-warning">Please Subscribe</a></td>
        @endif 
       
    @endif
@else
    <td>-</td>
@endif