<?php $i = 1 ; ?>
<div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Financial Info List</div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Year</th>
                        <th>Annual Excel</th>
                        <th>Annual PDF 1</th>
                        <th>Annual PDF 2</th>
                        <th>Annual PDF 3</th>
                        <th>Annual PDF 4</th>
                        <th>Annual PDF 5</th>
                        <th>Q1 PDF</th>
                        <th>Q1 Excel</th>
                        <th>Q2 PDF</th>
                        <th>Q2 Excel</th>
                        <th>Q3 PDF</th>
                        <th>Q3 Excel</th>
                        <th>Q4 PDF</th>
                        <th>Q4 Excel</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Year</th>
                        <th>Annual Excel</th>
                        <th>Annual PDF 1</th>
                        <th>Annual PDF 2</th>
                        <th>Annual PDF 3</th>
                        <th>Annual PDF 4</th>
                        <th>Annual PDF 5</th>
                        <th>Q1 PDF</th>
                        <th>Q1 Excel</th>
                        <th>Q2 PDF</th>
                        <th>Q2 Excel</th>
                        <th>Q3 PDF</th>
                        <th>Q3 Excel</th>
                        <th>Q4 PDF</th>
                        <th>Q4 Excel</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($company->financeInfos as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $item->year }}</td>
                        @if($item->annual_excel_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_excel_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_excel_url_file_name != null ? $item->annual_excel_url_file_name : 'Excel' }}</a></td>
                        @else
                            <td>No Excel</td>
                        @endif
                        @if($item->annual_pdf_1_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_pdf_1_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_pdf_1_url_file_name != null ? $item->annual_pdf_1_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->annual_pdf_2_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_pdf_2_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_pdf_2_url_file_name != null ? $item->annual_pdf_2_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->annual_pdf_3_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_pdf_3_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_pdf_3_url_file_name != null ? $item->annual_pdf_3_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->annual_pdf_4_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_pdf_4_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_pdf_4_url_file_name != null ? $item->annual_pdf_4_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->annual_pdf_5_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->annual_pdf_5_url }}" type="button" class="btn btn-outline-primary">{{ $item->annual_pdf_5_url_file_name != null ? $item->annual_pdf_5_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->q1__pdf_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q1__pdf_url }}" type="button" class="btn btn-outline-primary">{{ $item->q1__pdf_url_file_name != null ? $item->q1__pdf_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->q1_excel_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q1_excel_url }}" type="button" class="btn btn-outline-primary">{{ $item->q1_excel_url_file_name != null ? $item->q1_excel_url_file_name : 'Excel' }}</a></td>
                        @else
                            <td>No Excel</td>
                        @endif

                        @if($item->q2__pdf_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q2__pdf_url }}" type="button" class="btn btn-outline-primary">{{ $item->q2__pdf_url_file_name != null ? $item->q2__pdf_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->q2_excel_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q2_excel_url }}" type="button" class="btn btn-outline-primary">{{ $item->q2_excel_url_file_name != null ? $item->q2_excel_url_file_name : 'Excel' }}</a></td>
                        @else
                            <td>No Excel</td>
                        @endif


                        @if($item->q3__pdf_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q3__pdf_url }}" type="button" class="btn btn-outline-primary">{{ $item->q3__pdf_url_file_name != null ? $item->q3__pdf_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->q3_excel_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q3_excel_url }}" type="button" class="btn btn-outline-primary">{{ $item->q3_excel_url_file_name != null ? $item->q3_excel_url_file_name : 'Excel' }}</a></td>
                        @else
                            <td>No Excel</td>
                        @endif


                        @if($item->q4__pdf_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q4__pdf_url }}" type="button" class="btn btn-outline-primary">{{ $item->q4__pdf_url_file_name != null ? $item->q4__pdf_url_file_name : 'PDF' }}</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->q4_excel_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->q4_excel_url }}" type="button" class="btn btn-outline-primary">{{ $item->q4_excel_url_file_name != null ? $item->q4_excel_url_file_name : 'Excel' }}</a></td>
                        @else
                            <td>No Excel</td>
                        @endif


                        <td>
                            <a href="{{ route('finance-info.show', $item->id)}}" class="btn btn-outline-primary">Show</a>
                            <form action="{{ route('finance-info.destroy', $item->id)}}" onclick="return confirm('Are you sure, you want to delete this financial info?')" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
