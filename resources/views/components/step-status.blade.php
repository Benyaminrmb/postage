<ul class="navbar-nav">
    <li class="nav-item ">

        <div class="btn-group btn-group-toggle btn-group-sm btnStepStatusGroup" data-toggle="buttons">
            @if($shipment->accessResponse === 'granted')
                <label class="btn btn-sm font-13 {{ $btnClass }} {{ $accessResponse }}"
                       onclick="changeStepStatus($(this))">
                    <input type="radio" name="notApproved"
                           value="notApproved"
                           data-shipment-id="{{ $shipment->id }}"
                           data-route="{{ route('admin.shipment.editStepStatus') }}"
                           @if($stepStatus === 'notApproved')
                           checked
                           @endif
                           id="option1" autocomplete="off">
                    <span class="detail"></span>
                    تایید نشده
                </label>
                <label class="btn btn-sm font-13 {{ $btnClass }} {{ $accessResponse }}"
                       onclick="changeStepStatus($(this))">
                    <input type="radio" name="onProcess"
                           value="onProcess"
                           data-shipment-id="{{ $shipment->id }}"
                           data-route="{{ route('admin.shipment.editStepStatus') }}"
                           @if($stepStatus === 'onProcess')
                           checked
                           @endif
                           id="option1" autocomplete="off">
                    <span class="detail"></span>
                    در حال پردازش
                </label>
                <label class="btn btn-sm font-13 {{ $btnClass }} {{ $accessResponse }}"
                       onclick="changeStepStatus($(this))">
                    <input type="radio" name="getProduct"
                           value="getProduct"
                           data-shipment-id="{{ $shipment->id }}"
                           data-route="{{ route('admin.shipment.editStepStatus') }}"
                           @if($stepStatus === 'getProduct')
                           checked
                           @endif
                           id="option1" autocomplete="off">
                    <span class="detail"></span>
                    گرفتن مرسوله
                </label>
                <label class="btn btn-sm font-13 {{ $btnClass }} {{ $accessResponse }}"
                       onclick="changeStepStatus($(this))">
                    <input type="radio" name="onTheWay"
                           value="onTheWay"
                           data-shipment-id="{{ $shipment->id }}"
                           data-route="{{ route('admin.shipment.editStepStatus') }}"
                           @if($stepStatus === 'onTheWay')
                           checked
                           @endif
                           id="option1" autocomplete="off">
                    <span class="detail"></span>
                    در مسیر
                </label>
                <label class="btn btn-sm font-13 {{ $btnClass }} {{ $accessResponse }}"
                       onclick="changeStepStatus($(this))">
                    <input type="radio" name="receivedByTheRecipient"
                           value="receivedByTheRecipient"
                           data-shipment-id="{{ $shipment->id }}"
                           data-route="{{ route('admin.shipment.editStepStatus') }}"
                           @if($stepStatus === 'receivedByTheRecipient')
                           checked
                           @endif
                           id="option1" autocomplete="off">
                    <span class="detail"></span>
                    تحویل داده شد
                </label>
            @else
                <span class="text-danger">دسترسی ندارید</span>
            @endif

        </div>
    </li>
</ul>
