<?php
$basePath = $assetBase ?? '';
$currentRole = $currentRole ?? 'director';
$dashboards = [
    'director' => '/dashboard/director',
    'teacher' => '/dashboard/teacher',
    'inspector' => '/dashboard/inspector',
    'pie' => '/dashboard/pie',
    'guardian' => '/dashboard/guardian',
    'student' => '/dashboard/student',
    'finance' => '/dashboard/finance',
];
$menuByRole = [
    'director' => [
        'Gestión' => [
            ['Establecimiento', '/establishment/profile'],
            ['Usuarios y Roles', '/users'],
            ['Años Académicos', '/establishment/academic-years'],
            ['Cursos y Asignaturas', '/establishment/courses'],
            ['Matrícula', '/enrollment/students'],
        ],
        'Libro de Clases' => [
            ['Asistencia', '/attendance/daily'],
            ['Calificaciones', '/attendance/grades'],
            ['Actas y Reportes', '/attendance/reports'],
        ],
        'Currículum' => [
            ['Planificación', '/curriculum/plans'],
            ['Cobertura', '/curriculum/coverage'],
        ],
        'Evaluación' => [
            ['Evaluaciones', '/evaluations'],
            ['Banco de Preguntas', '/evaluations/bank'],
            ['Resultados', '/evaluations/results'],
            ['Reforzamiento', '/evaluations/remedial'],
        ],
        'Convivencia' => [
            ['Anotaciones', '/behavior/notes'],
        ],
        'Reportes' => [
            ['Centro de Reportes', '/reports'],
        ],
        'Comunicación' => [
            ['Mensajería', '/communications/inbox'],
            ['Comunicados', '/communications/broadcast'],
        ],
        'Finanzas' => [
            ['Cobros', '/finance/charges'],
            ['Pagos', '/finance/payments'],
            ['Morosidad', '/finance/reports'],
        ],
        'Sistema' => [
            ['Auditoría', '/system/audit'],
            ['Backups', '/system/backups'],
            ['Versiones DB', '/system/db-versions'],
        ],
    ],
    'teacher' => [
        'Libro de Clases' => [
            ['Asistencia', '/attendance/daily'],
            ['Calificaciones', '/attendance/grades'],
            ['Libro de notas', '/attendance/gradebook'],
        ],
        'Currículum' => [
            ['Planificación', '/curriculum/plans'],
            ['Unidades', '/curriculum/units'],
            ['Clases', '/curriculum/classes'],
        ],
        'Evaluación' => [
            ['Evaluaciones', '/evaluations'],
            ['Aplicación', '/evaluations/apply'],
            ['Resultados', '/evaluations/results'],
        ],
        'Reportes' => [
            ['Reporte notas', '/reports/grades'],
        ],
    ],
    'inspector' => [
        'Convivencia' => [
            ['Anotaciones', '/behavior/notes'],
            ['Incidentes', '/behavior/incidents'],
            ['Reportes', '/behavior/reports'],
        ],
        'Asistencia' => [
            ['Diaria', '/attendance/daily'],
            ['Mensual', '/attendance/monthly'],
        ],
        'Reportes' => [
            ['Reporte convivencia', '/reports/behavior'],
        ],
    ],
    'pie' => [
        'Estudiantes' => [
            ['Ficha convivencia', '/behavior/student'],
            ['Banco de OA', '/curriculum/bank'],
        ],
        'Evaluación' => [
            ['Rúbricas', '/evaluations/rubric'],
            ['Resultados', '/evaluations/results'],
        ],
        'Reportes' => [
            ['Reporte cobertura', '/reports/coverage'],
        ],
    ],
    'guardian' => [
        'Estudiante' => [
            ['Ficha estudiante', '/enrollment/students/show'],
            ['Documentos', '/enrollment/documents'],
        ],
        'Asistencia' => [
            ['Resumen mensual', '/attendance/monthly'],
        ],
        'Reportes' => [
            ['Reporte asistencia', '/reports/attendance'],
        ],
    ],
    'student' => [
        'Mi progreso' => [
            ['Calificaciones', '/attendance/grades'],
            ['Evaluaciones', '/evaluations/results'],
        ],
        'Reportes' => [
            ['Reporte evaluación', '/reports/evaluations'],
        ],
    ],
    'finance' => [
        'Finanzas' => [
            ['Listado de cobros', '/finance/charges'],
            ['Plan de pagos', '/finance/plans'],
            ['Registro de pago', '/finance/register'],
            ['Morosidad', '/finance/reports'],
        ],
        'Reportes' => [
            ['Reporte ingresos', '/finance/income'],
            ['Exportaciones', '/reports/exports'],
        ],
    ],
];
$sections = $menuByRole[$currentRole] ?? $menuByRole['director'];
?>
<nav class="main-nav">
    <ul class="nav flex-column p-3">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $basePath . ($dashboards[$currentRole] ?? $dashboards['director']); ?>">
                Inicio (Dashboard)
            </a>
        </li>
        <?php foreach ($sections as $section => $items): ?>
            <li class="nav-item mt-3 fw-bold"><?php echo htmlspecialchars($section); ?></li>
            <?php foreach ($items as [$label, $path]): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath . $path; ?>"><?php echo htmlspecialchars($label); ?></a>
                </li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
</nav>
