<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JurnalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'tanggal'     => $this->tanggal,
            'judul'       => $this->judul,
            'deskripsi'   => $this->deskripsi,
            'status'      => $this->status,
            'kategori_id' => $this->kategori_id,
            'kategori'    => $this->whenLoaded('kategori', function () {
                return $this->kategori->nama ?? null;
            }),
            'user_id'     => $this->user_id,
            'created_at'  => $this->created_at?->toIso8601String(),
            'updated_at'  => $this->updated_at?->toIso8601String(),
        ];
    }
}