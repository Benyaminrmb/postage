<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $arrayValues = ['byUser','byCompany'];
        $arrayValues4 = ['byCar','byRail','byAir'];
        $arrayValues5 = ['{"name":"\u0627\u0633\u0645 \u0645\u062d\u0635\u0648\u0644","count":"5","weight":"200 \u06a9\u06cc\u0644\u0648","volume":"10"}',
            '{"name":"\u0646\u0627\u0645\u0647","count":"1","weight":"0.2","volume":"10"}',
            '{"name":"\u0646\u0627\u0645\u0647","count":"1","weight":"0.2","volume":"10"}'];
        $arrayValues2 = ['{"string":"\u062a\u0647\u0631\u0627\u0646 \u062e\u06cc\u0627\u0628\u0627\u0646 \u06cc\u06a9\u0645","state":"8","city":"349","onMap":{"long":"51.363","lat":"35.671"}}',
            '{"string":"\u0645\u0633\u06a9\u0646 \u0634\u0647\u0631 \u062a\u0647\u0631\u0627\u0646 \u0628\u0632\u0631\u06af","onMap":{"long":"51.355","lat":"35.672"}}',
            '{"string":"\u0645\u0633\u06a9\u0646 \u0634\u0647\u0631 \u062a\u0647\u0631\u0627\u0646 \u0628\u0632\u0631\u06af","state":"1","city":"32","onMap":{"long":"51.355","lat":"35.672"}}'];
        $arrayValues3 = ['{"name":"\u0633\u0639\u06cc\u062f","family":"\u0639\u0644\u06cc\u0632\u0627\u062f\u0647","mobile":"0910852554","nationalCode":"654165484151"}',
            '{"name":"\u0633\u0639\u06cc\u062f","family":"\u0639\u0644\u06cc\u0632\u0627\u062f\u0647","mobile":"0910852554","nationalCode":"654165484151"}',
            '{"name":"\u0633\u0639\u06cc\u062f","family":"\u0639\u0644\u06cc\u0632\u0627\u062f\u0647","mobile":"0910852554","nationalCode":"654165484151"}'];
        return [
            'user_id' =>User::factory(),
            'deliveryType' => $arrayValues[random_int(0,1)],
            'originAddress' => $arrayValues2[random_int(0,2)],
            'destinationAddress' => $arrayValues2[random_int(0,2)],
            'receiverInformation' => $arrayValues3[random_int(0,2)],
            'deliveryVehicle' => $arrayValues4[random_int(0,2)],
            'postalInformation' => $arrayValues5[random_int(0,2)],
            'accessResponse' => 'denied',
            'dataResponse' => '',

        ];
    }
}
