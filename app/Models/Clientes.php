<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Clientes extends Authenticatable
{
	use Notifiable;
	
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'status', 'documento', 'data_nascimento', 'email', 'email_verified_at', 'password', 'apelido', 'sexo', 'id_imagem', '_token', 'remember_token', 'created_at', 'updated_at'];

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        // Return name and email address...
        return [$this->email => $this->nome];
    }
    
    public function RelationTelefones(){
    	return $this->belongsTo(Telefones::class, 'id', 'id_cliente');
    }
    public function RelationEnderecos(){
    	return $this->hasMany(Enderecos::class, 'id_cliente', 'id');
    }
    public function RelationFavoritos(){
        return $this->hasMany(Favoritos::class, 'id_cliente', 'id');
    }
}
