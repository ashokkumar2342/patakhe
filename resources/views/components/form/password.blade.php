<div class="form-group">
    {!! Form::labelHtml($name, $label, $labelAttr) !!}
    {{ Form::password($name, array_merge(['class' => 'form-control'], $inputAttr)) }}
    <div class="text-danger">{{$errors->first($name)}}</div>
</div>