-- Add "com_cronjobs" to "#__extensions"
INSERT INTO "#__extensions" ("package_id", "name", "type", "element", "folder", "client_id", "enabled", "access",
							 "protected", "locked", "manifest_cache", "params", "custom_data", `checked_out`, `checked_out_time`, "ordering", "state")
VALUES (0, 'com_guidedtours', 'component', 'com_guidedtours', '', 1, 1, 0, 0, 1, '', '{}', '', 0, NULL, 0, 0);

-- Add "plg_job_testjob" to "#__extensions"
INSERT INTO "#__extensions" ("package_id", "name", "type", "element", "folder", "client_id", "enabled", "access",
							 "protected", "locked", "manifest_cache", "params", "custom_data", `checked_out`, `checked_out_time`, "ordering", "state")
VALUES (0, 'plg_system_tour', 'plugin', 'tour', 'system', 0, 1, 1, 0, 1, '', '{}', '',0, NULL,  1, 0);
