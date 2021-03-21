<div class="col-md-12">
    <div class="row">
        @foreach ($sellingTransaction as $row)
            <div class="col card mr-1 ml-1 maxwidth-18 tab-parent">
                <div class="row trx-tab">
                    <input type="hidden" class="tab-index" value="">
                    <div class="col overflow-hidden no-wrap trx">
                        <input id="selling-transaction-id" type="hidden" value="{{ $row->id }}">
                        <span class="trx-number" id="selling-transaction-number">{{ $row->transaction_number }}</span>
                    </div>
                    <div class="col-2 text-right small text-muted"><small class="hover btn-xs close-tab"
                            onclick="closeTab({{ $row->id }})">&#10005;</small></div>
                </div>
            </div>
        @endforeach
        <div class="col mr-1 ml-1 hover add-tab" onclick="addNewTransaction()">
            +
        </div>
    </div>
</div>
