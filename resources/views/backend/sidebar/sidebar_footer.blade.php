</div><!--sidebar-body  -->
<div class="sidebar-footer text-right d-flex justify-space-between">
    @php
        $param = $param ?? [];
    @endphp

    @foreach ($param as $key => $value)
        @if (is_string($key) && str_starts_with(strtolower($key), 'hidden:'))
            @php
                $name = substr($key, 7); // 'hidden:' is 7 chars
            @endphp
            @if (!empty($name))
                <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
            @endif
        @elseif(is_string($key) && str_starts_with(strtolower($key), 'hidde:'))
            @php
                $name = substr($key, 6); // 'hidde:' is 6 chars (typo fallback)
            @endphp
            @if (!empty($name))
                <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
            @endif
        @endif
    @endforeach
    <?= __submitBtn() ?>
</div><!-- card-footer -->
</div>
</form><!-- form -->
</div><!-- sidebar-content -->

</div><!-- sidebar-modal -->
