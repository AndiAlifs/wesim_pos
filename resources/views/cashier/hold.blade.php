<div class="col-md-12">
    <div class="row">
        @foreach ($sellingTransaction as $row)
            <div class="col card mr-1 ml-1 active-trx maxwidth-18">
                <div class="row">
                    <div class="col overflow-hidden no-wrap trx"><input class="trx-id" type="hidden"
                            value="{{ $row->id }}"><span class="trx-number">{{ $row->transaction_number }}</span>
                    </div>
                    <div class="col-2 text-right small text-muted"><small>&#10005;</small></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
