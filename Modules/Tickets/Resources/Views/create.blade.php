@extends("app::layouts.app")

@section('app')

    @php
        $pageTitle = 'Create ticket';
    @endphp
    <h1 class="uk-text-right">
        <a class="btn btn-secondary" href="{{ Route('ticket.index') }}">&larr; Back to tickets</a>
    </h1>

    @if (session('status') == 500)
        @foreach (session('errors') as $errors)
            <div class="alert alert-danger">
                @foreach ($errors as $error)
                    {{ $error }}<br />
                @endforeach
            </div>
        @endforeach
    @elseif (session('status') == 200)
        <div class="alert alert-success">
            Ticket successfully created
        </div>
    @endif
    <div class="panel">
        <div class="panel-body">
            <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label">Title: <span class="text-danger">*</span></label>
                    <div>
                        <input class="form-control" type="text" name="title" placeholder="Title"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Category: <span class="text-danger">*</span></label>
                    <div>
                        <select name="category" class="form-control">
                            @foreach ($categories as $categoryId => $category)
                                <option value="{{ $categoryId }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Description: <span class="text-danger">*</span></label>
                    <div>
                        <textarea class="form-control" name="message" rows="5" placeholder="Enter ticket description..."></textarea>
                    </div>

                </div>
                <div class="form-group">
                    <div class="input_files">
                    </div>
                    <span class="add_file btn btn-default">Add input file</span>
                </div>
                <div class="form-group">
                    <input type="submit" value="Create Ticket" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #page-wrapper {
            position: relative;
        }

        .footer {
            left: 0 !important;
        }

        h1 {
            padding-top: 20px !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        var countFiles = 0;

        $('.add_file').on('click', function() {
            if (countFiles < 10) {
                var html = '<div class="form-group"><input type="file" name="files['+ countFiles++ +']"/></div>';
                $('.input_files').append(html);
            }
        });
    </script>
    <script src="/build/js/backend/tickets/tickets.min.js"></script>

@endpush