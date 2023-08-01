<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    public $expiry_date;
    
    public function mount($coupon_id)
    {
        $coupons = Coupon::find($coupon_id);
        $this->code = $coupons->code;
        $this->type = $coupons->type;
        $this->value = $coupons->value;
        $this->cart_value = $coupons->cart_value;
        $this->coupon_id = $coupon_id;
        $this->expiry_date = $coupons->expiry_data;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'code'=>'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            'expiry_date'=>'required',
        ]);
    }

    public function updateCoupon()
    {
        $this->validate([
            'code'=>'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            'expiry_date'=>'required',
        ]);

        $coupons = Coupon::find($this->coupon_id);
        $coupons->code = $this->code;
        $coupons->type = $this->type;
        $coupons->value = $this->value;
        $coupons->cart_value = $this->cart_value;
        $coupons->expiry_date = $this->expiry_date;
        $coupons->save();
        session()->flash('message', 'coupons has been updated successfully');

    }
    public function render()
    {
        return view('livewire.admin.admin-edit-coupons-component')->layout('layouts.base');
    }
}
