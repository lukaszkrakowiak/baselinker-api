# Baselinker API

Documentation: https://api.baselinker.com/

## Installation

```sh
composer require lukaszkrakowiak/baselinerk-api
```

## USE

Require methods
```sh
use Baselinker\Resource\Method;
use Baselinker\Resource\Token;
```

Set Token

```sh
$token = new Token();
$token->setToken("your-token");
```

Create Query

```sh
(new Method($token))->parameter("method_name", array_parameter)->send();
```


