<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    private array $types = ['C' => 'Cartão', 'B' => 'Boleto', 'D' => 'Pix'];

    public function toArray(Request $request): array
    {
        $paid = $this->paid;
        return [
            'user' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullName' => $this->user->firstName . ' ' .$this->lastName,
                'email' => $this->user->email
            ],
            'user_id' => $this->user_id,
            'type' => $this->types[$this->type],
            'paid' => $paid ? 'Pago' : 'Não pago',
            'value' => 'R$ ' . number_format($this->value,2, ',', ','),
            'payment_date' => $paid ? Carbon::parse($this->payment_date)->format('d/m/Y H:i:s') : Null,
            'payment_since' => $paid ? Carbon::parse($this->payment_date)->diffForHumans() : Null,

        ];
    }
}
