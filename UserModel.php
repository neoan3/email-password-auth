<?php
/* Generated by neoan3-cli */

namespace Neoan3\Model\User;

use Neoan3\Core\RouteException;
use Neoan3\Provider\MySql\Database;
use Neoan3\Provider\Model\Model;
use Neoan3\Provider\MySql\Transform;

/**
 * Class UserModel
 * @package Neoan3\Model\User
 * @method static get(string $id)
 * @method static update(array $modelArray, array $modifier = [])
 * @method static find(array $conditionArray, array $callFunctions = [])
 * @method static delete(string $id, bool $hard = false)
 */

class UserModel implements Model{

    /**
     * @var Database|null
     */
    private static ?Database $db = null;

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        if(!method_exists(self::class, $method)){
            $transform = new Transform('user', self::$db);
            return self::out($transform->$method(...$args));
        } else {
            return self::out(self::$method(...$args));
        }
    }

    public static function out($model)
    {
        if(isset($model['password'])){
            unset($model['password']);
        } else {
            foreach ($model as $i => $item){
                unset($model[$i]['password']);
            }
        }
        return $model;
    }

    /**
     * @throws RouteException
     */
    public static function login($credentials)
    {
        $credentials = self::validate($credentials);
        $find = self::$db->easy('user.id user.password',['email'=>$credentials['email']]);
        if(empty($find)){
            throw new RouteException('unauthorized',401);
        }
        if(!password_verify($credentials['password'], $find[0]['password'])){
            throw new RouteException('unauthorized',401);
        }
        return self::get($find[0]['id']);
    }

    /**
     * @throws RouteException
     */
    public static function create($modelArray)
    {
        return self::register($modelArray);
    }

    /**
     * @throws RouteException
     */
    public static function register($credentials)
    {
        // validate
        $credentials = self::validate($credentials);
        $credentials['password'] = '=' . password_hash($credentials['password'], PASSWORD_DEFAULT);
        return self::create($credentials);
    }

    /**
     * @throws RouteException
     */
    private static function validate($input): array
    {
        if(!isset($input['email']) || !isset($input['password'])){
            throw new RouteException('Bad request: set "email" and "password"',400);
        }
        return [
            'email' => $input['email'],
            'password' => $input['password']
        ];
    }

    /**
     * @param array $providers
     */
    public static function init(array $providers)
    {
        foreach ($providers as $key => $provider){
            if($key === 'db'){
                self::$db = $provider;
            }
        }
    }

}
