@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($cert)
                <div class="card-header">Certificate Found</div>

                <div class="card-body text-center">
                    <a href="{{ Storage::disk('public')->url($cert->certificate_file) }}" target="_blank" class="btn btn-primary">Download Now</a>
                </div>
                @else
                    @if ($search)
                        <div class="card-header">Certificate Not Found - Try Again</div>
                    @else
                        <div class="card-header">Locate Certificate</div>
                    @endif
                <div class="card-body">
                    <form method="GET" name="search" role="search">
                        <div class="form-group row">
                            <label for="part" class="col-sm-2 col-form-label">Part #</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="part">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lot" class="col-sm-2 col-form-label">Lot #</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lot">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="po" class="col-sm-2 col-form-label">PO#</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="po">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
