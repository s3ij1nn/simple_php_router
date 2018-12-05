```
$r = new Router;
if($r->match_uri('download/([^/]*)/([^/]*)/(.*)$') === true){
  // array(4) { [0]=> string(28) "/download/key/2key/file.name" [1]=> string(3) "key" [2]=> string(4) "2key" [3]=> string(9) "file.name" }
  var_dump($r->argv);
}

if($r->method(['GET', 'POST', 'OPTION']) === true){
  // string(3) "GET"
  var_dump($r->method)
}

if($r->method() === true){
  //request GET
  echo "GET request success";
}

if($r->router('GET', '/') === true){
  // request hostname/
  echo "success access GET with /";
}

// function autoload

function mainpage(){
  echo "success access GET with /";
}
$r->router('GET', '/', 'mainpage');

otherfile.php
```
namespace Tmp;
class otherfile{
  public function mainpage(){
    echo "success access GET with /";
  }
  public static function helloworld(){
    echo "success access GET or POST with /helloword";
  }
}
```
$r->router('GET', '/', '\Tmp\otherfile@mainpage');
$r->router(['GET', 'POST'], '\Tmp\otherfile::helloworld');

$match_uri pattern doc
  $r->match_uri($match_uri or $r->router('GET', $match_uri

  $ ← lastwords
  () ← match and save argv
  . ←  match one word
  .* ← match everything
  .? ← match 0 or 1 word
  [0-9] only 123456789
  [a-z] only abcdefg...z
  [A-Z] only ABCDEFG...Z
  [0-9a-zA-Z] match 0-9 and a-z and A-Z
  [^0-9] not match 0-9
  [^/] not match /
  [^/]* while to match /
http://hostname/helloworld  'helloworld'
http://hostname/user/123456 'user/([0-9]*)$
http://hostname/user/hello  'user/([a-z]*)$
http://hostname/user/h311o   ↑ not match
http://hostname/anyk1nd/anyk3y/filename.txt '([a-zA-Z0-9][^/]*)/([a-zA-Z0-9][^/]*)/(.*)$'
result
['/anyk1nd/anyk3y/filename.txt', 'anyk1nd', 'anyk3y', 'filename.txt']
```
