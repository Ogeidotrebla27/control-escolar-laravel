<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==========================================
        // CREAR PERMISOS
        // ==========================================
        $permisos = [
            // Alumnos
            'ver alumnos',
            'crear alumnos',
            'editar alumnos',
            'eliminar alumnos',
            
            // Tutores
            'ver tutores',
            'crear tutores',
            'editar tutores',
            'eliminar tutores',
            
            // Personal
            'ver personal',
            'crear personal',
            'editar personal',
            'eliminar personal',
            
            // Bitácora
            'ver bitacora',
            'crear bitacora',
            'editar bitacora',
            'eliminar bitacora',
            
            // Permisos
            'ver permisos',
            'crear permisos',
            'editar permisos',
            'eliminar permisos',
            'autorizar permisos',
            
            // Calificaciones
            'ver calificaciones',
            'crear calificaciones',
            'editar calificaciones',
            'eliminar calificaciones',
            
            // Inventario
            'ver inventario',
            'crear inventario',
            'editar inventario',
            'eliminar inventario',
            
            // Reportes
            'ver reportes',
            'exportar reportes',
            
            // Configuración
            'ver configuracion',
            'editar configuracion',
            
            // Usuarios
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }

        // ==========================================
        // CREAR ROLES
        // ==========================================

        // 1. Administrador (control total)
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        // 2. Director (todo excepto configuración)
        $director = Role::create(['name' => 'Director']);
        $director->givePermissionTo([
            'ver alumnos', 'crear alumnos', 'editar alumnos', 'eliminar alumnos',
            'ver tutores', 'crear tutores', 'editar tutores', 'eliminar tutores',
            'ver personal', 'crear personal', 'editar personal', 'eliminar personal',
            'ver bitacora', 'crear bitacora', 'editar bitacora', 'eliminar bitacora',
            'ver permisos', 'crear permisos', 'editar permisos', 'eliminar permisos', 'autorizar permisos',
            'ver calificaciones', 'crear calificaciones', 'editar calificaciones', 'eliminar calificaciones',
            'ver inventario', 'crear inventario', 'editar inventario', 'eliminar inventario',
            'ver reportes', 'exportar reportes',
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'eliminar usuarios',
        ]);

        // 3. Subdirector (similar al director)
        $subdirector = Role::create(['name' => 'Subdirector']);
        $subdirector->givePermissionTo([
            'ver alumnos', 'crear alumnos', 'editar alumnos', 'eliminar alumnos',
            'ver tutores', 'crear tutores', 'editar tutores', 'eliminar tutores',
            'ver personal', 'crear personal', 'editar personal', 'eliminar personal',
            'ver bitacora', 'crear bitacora', 'editar bitacora', 'eliminar bitacora',
            'ver permisos', 'crear permisos', 'editar permisos', 'eliminar permisos', 'autorizar permisos',
            'ver calificaciones', 'crear calificaciones', 'editar calificaciones', 'eliminar calificaciones',
            'ver inventario', 'crear inventario', 'editar inventario', 'eliminar inventario',
            'ver reportes', 'exportar reportes',
        ]);

        // 4. Docente
        $docente = Role::create(['name' => 'Docente']);
        $docente->givePermissionTo([
            'ver alumnos',
            'ver bitacora', 'crear bitacora',
            'ver permisos', 'crear permisos',
            'ver calificaciones',
            'ver reportes',
        ]);

        // 5. Administrativo
        $administrativo = Role::create(['name' => 'Administrativo']);
        $administrativo->givePermissionTo([
            'ver alumnos', 'crear alumnos', 'editar alumnos', 'eliminar alumnos',
            'ver tutores', 'crear tutores', 'editar tutores', 'eliminar tutores',
            'ver personal', 'crear personal', 'editar personal', 'eliminar personal',
            'ver bitacora', 'crear bitacora', 'editar bitacora', 'eliminar bitacora',
            'ver permisos', 'crear permisos', 'editar permisos', 'eliminar permisos',
            'ver calificaciones', 'crear calificaciones', 'editar calificaciones', 'eliminar calificaciones',
            'ver inventario', 'crear inventario', 'editar inventario', 'eliminar inventario',
            'ver reportes', 'exportar reportes',
        ]);

        // 6. PAAE (Personal de Apoyo)
        $paae = Role::create(['name' => 'PAAE']);
        $paae->givePermissionTo([
            'ver permisos', 'crear permisos',
            'ver inventario',
        ]);

        $this->command->info('✅ Roles y permisos creados correctamente.');
    }
}
