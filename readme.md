# Profile

#### Laravel 5.5+ Module

Este pacote é um módulo para adicionar Perfil de usuário numa aplicação Laravel 5.5 ou maior.

## Instalação

Certifique-se que sua aplicação tenha o pacote **nwidart/laravel-modules** adicionado antes de prosseguir, se não tiver instale com:

```
composer require nwidart/laravel-modules
```

Próximo passo é adicionar o módulo:


```
composer require laravelmodules/profile-module
```


Configure o **policy service provider** adicionando-o no arquivo `config/app.php` no array de **providers**:

```
...

	/*
	 * Modules Service Providers
 	 */
    \Modules\Profile\Providers\ProfilePolicyProvider::class
...    
```

Este service provider provê regras de acesso as rotas de perfil, mude-as conforme necessário, por padrão, somente o próprio usuário tem acesso ao seu perfil.

Há duas regras definidas: 

* `profile.access` que utiliza o valor contido na configuração **user.route-key-name**, que usa o valor dessa chave para verificar se é o próprio usuário quem está acessando o perfil.

* `profile` que compara o **user_id** do perfil com o **id** do usuário autenticado.

## AVISO

> Observe que o local padrão da instalação por demanda deste tipo de módulo é sempre na pasta **modules** na raiz do seu projeto Laravel.

## Habilitando o Perfil

No model **User** adicione a trait `HasProfile`

```php
class User extends Authenticatable
{
    use Notifiable, HasProfile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

Esta trait adiciona o método **profile** no model **User** para o relacionamento entre os **Models**.

## Migrations

Efetue as migrações para a criação da tabela de perfis no banco.

```
php artisan module:migration
```
ou se quiser fazer a migração apenas deste módulo...

```
php artisan module:migration Profile
```

## Configuração

Por padrão, este módulo utiliza o model que vem incluído no Laravel **App\User**, se por acaso você utiliza outro model, usa outro namespace, ou qualquer outra forma que não seja a padrão, abra o arquivo de configuração do módulo e faça as alterações necessárias.

**O arquivo de configuração padrão:** `modules/Profile/Config/config.php`

```php
return [
    'name' => 'Profile',
    'models' => [
        'user' => \App\User::class,
        'profile' => \Modules\Profile\Models\Profile::class
    ],
    'user' => [
        'route-key-name' => 'email'
    ]
];
```

Essa configuração é acessada via **helper** `config`.

* **user.model:** nome da classe/model **User** da sua aplicação. 
	- **Valor Padrão:** `\App\User::class`
* **user.route-key-name:** campo usado como chave para **rotas**. 
	- **Valor Padrão:** `email`

### Dependências:

* **laracasts/flash**: [https://github.com/laracasts/flash](https://github.com/laracasts/flash)
* **jjsquady/laravel-module-installer**: [https://github.com/jjsquady/laravel-module-installer](https://github.com/jjsquady/laravel-module-installer)

### Licença:

MIT
