<?php

use App\Models\User;

it('puede guardar una habitación', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('habitaciones.store'), [
        'numero' => '101',
        'piso' => 1,
        'tipo' => 'Doble',
        'capacidad' => 2,
        'precio' => 120.50,
        'estado' => 'libre',
        'descripcion' => 'Vista al jardín',
    ]);

    $response->assertRedirect(route('habitaciones.index'));
    $this->assertDatabaseHas('habitaciones', [
        'numero' => '101',
        'tipo' => 'Doble',
        'estado' => 'libre',
    ]);
});

it('puede ver el detalle de una habitación', function () {
    $user = User::factory()->create();

    $habitacion = \App\Models\Habitacion::create([
        'numero' => '202',
        'piso' => 2,
        'tipo' => 'Suite',
        'capacidad' => 3,
        'precio' => 320.00,
        'estado' => 'ocupada',
        'descripcion' => 'Vista panorámica',
    ]);

    $response = $this->actingAs($user)->get(route('habitaciones.show', $habitacion));

    $response->assertOk();
    $response->assertSee('202');
    $response->assertSee('Suite');
    $response->assertSee('Vista panorámica');
});

it('puede cambiar el estado de una habitación', function () {
    $user = User::factory()->create();

    $habitacion = \App\Models\Habitacion::create([
        'numero' => '303',
        'piso' => 3,
        'tipo' => 'Doble',
        'capacidad' => 2,
        'precio' => 180.00,
        'estado' => 'libre',
        'descripcion' => 'Cerca del elevador',
    ]);

    $response = $this->actingAs($user)->patch(route('habitaciones.updateStatus', $habitacion), [
        'estado' => 'ocupada',
    ]);

    $response->assertRedirect(route('habitaciones.show', $habitacion));
    $this->assertDatabaseHas('habitaciones', [
        'id' => $habitacion->id,
        'estado' => 'ocupada',
    ]);
});
