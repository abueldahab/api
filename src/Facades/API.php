<?php namespace Dingo\Api\Facades;

use Closure;
use Dingo\Api\Http\InternalRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Dingo\Api\Routing\Router
 */
class API extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'dingo.api.dispatcher'; }

	/**
	 * Bind an exception handler.
	 * 
	 * @param  \Closure  $callback
	 * @return void
	 */
	public static function error(Closure $callback)
	{
		return static::$app['dingo.api.exception']->register($callback);
	}

	/**
	 * Get the authenticated access token.
	 * 
	 * @return \Dingo\OAuth2\Entity\Token
	 */
	public static function token()
	{
		return static::$app['dingo.oauth.resource']->getToken();
	}

	/**
	 * Issue an access token to the API.
	 * 
	 * @param  array  $payload
	 * @return mixed
	 */
	public static function issueToken(array $payload)
	{
		return static::$app['dingo.oauth.authorization']->issueAccessToken($payload);
	}

	/**
	 * Get the authenticated API user.
	 * 
	 * @return \Illuminate\Auth\GenericUser|\Illuminate\Database\Eloquent\Model
	 */
	public static function user()
	{
		return static::$app['dingo.api.auth']->getUser();
	}

	/**
	 * Determine if a request is internal.
	 * 
	 * @return bool
	 */
	public static function internal()
	{
		return static::$app['router']->getCurrentRequest() instanceof InternalRequest;
	}

}
