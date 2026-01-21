INSERT INTO regions (id, name, status) VALUES
(1, 'Región Metropolitana', 1);

INSERT INTO communes (id, region_id, name, status) VALUES
(1, 1, 'Santiago', 1);

INSERT INTO tenants (id, rbd, name, dependency, region_id, commune_id, status, created_by, updated_by)
VALUES (1, '12345', 'Colegio Demo Go Educa', 'Particular Subvencionado', 1, 1, 1, NULL, NULL);

INSERT INTO roles (id, tenant_id, name, description, status, created_by, updated_by) VALUES
(1, NULL, 'SuperAdmin', 'Administrador global del sistema', 1, NULL, NULL),
(2, 1, 'Director', 'Director del establecimiento', 1, NULL, NULL),
(3, 1, 'Docente', 'Docente del establecimiento', 1, NULL, NULL),
(4, 1, 'Apoderado', 'Apoderado del estudiante', 1, NULL, NULL);

INSERT INTO permissions (id, name, description, status, created_by, updated_by) VALUES
(1, 'tenants.manage', 'Gestionar establecimientos', 1, NULL, NULL),
(2, 'users.manage', 'Gestionar usuarios', 1, NULL, NULL),
(3, 'students.manage', 'Gestionar estudiantes', 1, NULL, NULL),
(4, 'attendance.manage', 'Gestionar asistencia', 1, NULL, NULL),
(5, 'evaluations.manage', 'Gestionar evaluaciones', 1, NULL, NULL),
(6, 'communications.manage', 'Gestionar comunicaciones', 1, NULL, NULL),
(7, 'payments.manage', 'Gestionar pagos', 1, NULL, NULL);

INSERT INTO permission_role (permission_id, role_id) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

INSERT INTO users (id, tenant_id, rut, email, password_hash, name, last_name, two_factor_enabled, status, created_by, updated_by)
VALUES (1, 1, '11111111-1', 'superadmin@goeduca.cl', '$2y$12$lM2qSQZ9jeM9jcdepoRGlOvHFoToeTJVj8piI5z6GCZnddxYgfbH.', 'Super', 'Admin', 0, 1, NULL, NULL);

INSERT INTO role_user (role_id, user_id) VALUES (1, 1);
