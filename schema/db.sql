CREATE TABLE IF NOT EXISTS accounts (
  id SERIAL NOT NULL,
  email varchar(45) NOT NULL,
  first varchar(45),
  last varchar(45),
  password varchar(45) NOT NULL,
  api_key varchar(45) NOT NULL,
  role varchar(10) DEFAULT 'user',
  params text DEFAULT NULL,
  disable varchar(1) DEFAULT 'N',
  PRIMARY KEY (id)
);

INSERT INTO accounts ( id, email, first, last, password, api_key, role, params, disable) VALUES (1, 'admin@mail.com', 'Admin', 'Adminko', '0192023a7bbd73250516f069df18b500', '0192023a7bbd73250516f069df18b500', 'admin', '', 'N');