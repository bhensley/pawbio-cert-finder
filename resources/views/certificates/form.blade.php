<div class="form-group {{ $errors->has('part') ? 'has-error' : ''}}">
    <label for="part" class="control-label">{{ 'Part Number' }}</label>
    <input class="form-control" name="part" type="text" id="part" value="{{ isset($certificate->part) ? $certificate->part : ''}}" required>
    {!! $errors->first('part', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lot') ? 'has-error' : ''}}">
    <label for="lot" class="control-label">{{ 'Lot Number' }}</label>
    <input class="form-control" name="lot" type="text" id="lot" value="{{ isset($certificate->lot) ? $certificate->lot : ''}}" required>
    {!! $errors->first('lot', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('po') ? 'has-error' : ''}}">
    <label for="po" class="control-label">{{ 'Po' }}</label>
    <input class="form-control" name="po" type="text" id="po" value="{{ isset($certificate->po) ? $certificate->po : ''}}" required>
    {!! $errors->first('po', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('certificate_file') ? 'has-error' : ''}}">
    <label for="certificate_file" class="control-label">{{ 'Certificate File' }}</label>
    <input class="form-control" name="certificate_file" type="file" id="certificate_file" value="{{ isset($certificate->certificate_file) ? $certificate->certificate_file : ''}}" required>
    {!! $errors->first('certificate_file', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
