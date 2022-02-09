<?php

$app->addBodyParsingMiddleware();

$app->post('/api/v1/auth', [AuthController::class, 'index'])
    ->add(new PasswordAuthMiddleware())
    ->add(new ValidationMiddleware([
        'login' => [
            new RequiredRule,
            new LengthRule(['min' => 3]),
        ]
    ]));

$app->post('/api/v1/register', [RegistrationController::class, 'index'])
    ->add(new ValidationMiddleware([
        'login' => [
            new RequiredRule,
            new LengthRule(['min' => 3]),
        ],
        'password' => [
            new RequiredRule,
            new TypeRule('string'),
            new LengthRule(['min' => 8])
        ],
        'role' => [
            new RequiredRule(false),
            new TypeRule('int')
        ]
    ]));

$app->get('/api/v1/profile/{id}', [ProfileController::class, 'index'])
    ->add(new JWTAuthMiddleware());

$app->get('/api/v1/logout', [AuthController::class, 'logout']);
$app->post('/api/v1/postman/auth', [PostmanController::class, 'index']);
