<header> 
	<h1>Social Media Website</h1> 
	<a href=" {{ route('account') }} ">Visit my account</a> 
	<a href=" {{ route('dashboard') }} ">Socialiase</a> 
	<a href=" {{ route('signout') }} ">Signout</a>
	<a href="{{ route('friend.index') }}">Friends</a>  
	<form role="search" action=" {{ route('search.results') }} "> 
		<input type="text" name="query" placeholder="Search for user..." /> 
	</form> 
</header> 
