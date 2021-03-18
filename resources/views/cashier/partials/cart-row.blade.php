{{-- ------------------------add to row list--------------------------- --}}
<div class="hide-list" id="hide-list">
    <div class="card cart-item border" id="cart-item" type="button">
        <div class="row">
            <div class="col-8 border-right border-secondary cart-hover" data-toggle="modal"
                data-target="#modal-default">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="p-1">
                            <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                alt="" width="60px" height="60x">
                            {{-- <b> {{ $row->name }}</b> --}}
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2 overflow-hidden">
                        <div>
                            <b class="overflow-hidden no-wrap" id="set-name">Lorem, ipsum dolor.</b>
                            <p class="small text-muted">Rp. <span id="set-price">xx.xxx</span> </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="vertical-center">
                            <div class="text-muted">
                                <span>&#10005;</span><span id="set-amount">xxx</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="vertical-center">
                    Rp. <span id="set-total">xx.xxx</span>
                    <span id="close-btn">
                        {{-- <button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteCart()">&#10005;</button> --}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
