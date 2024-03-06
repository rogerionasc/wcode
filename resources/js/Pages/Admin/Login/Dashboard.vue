<template>
    Bem vindo,
    <h3>{{ $page.props.auth.user.name }}</h3>
    <h3>{{ $page.props.auth.user.email }}</h3>
<!--    {user->name}-->

<a href="/logout">sair</a>
</template>
