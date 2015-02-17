<form action="{{ action('RemindersController@postReset') }}" method="POST">
    <input type="hidden" name="token" value="{{ $token }}">
    <label for ="email">Email: </label><input type="email" name="email">
    <label for ="password">Password: </label><input type="password" name="password">
    <label for ="password_confirmation">Confirm Password: </label><input type="password" name="password_confirmation">
    <input type="submit" value="Reset Password">
</form>