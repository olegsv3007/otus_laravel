<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="./img/montenegro.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Apartmani Vinici<span class="badge rounded-pill bg-success text-white ml-2">Заказ выполнен</span></h5>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.city') }}:</span><span class="ml-2">Danilovgrad</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.dates') }}:</span><span class="ml-2">17.02.2021-22.02.2021</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.quantity_people') }}:</span><span class="ml-2">2</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.price') }}:</span><span class="ml-2">$ 420</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.payment_method') }}:</span><span class="ml-2">Картой на сайте</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.payment_status') }}:</span><span class="ml-2">Оплата произведена в полном размере</span></p>
                <div class="row justify-content-between align-items-end m-1 mt-4">
                    <div><small class="text-muted">{{ __('public/pages/order_history.order_was_created') }} 2 Февраля 2021 года</small></div>
                    <a type="button" class="btn btn-danger" href="#">{{ __('public/pages/order_history.button_cancel_order_title') }}</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
