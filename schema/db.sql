DROP TABLE IF EXISTS accounts;
CREATE TABLE accounts (
  id SERIAL,
  email varchar(45) NOT NULL,
  first varchar(45),
  last varchar(45),
  password varchar(60) NOT NULL,
  api_key varchar(32) NOT NULL,
  role varchar(10) DEFAULT 'user',
  params text DEFAULT NULL,
  disable varchar(1) DEFAULT 'N',
  PRIMARY KEY (id)
);

INSERT INTO accounts (email, first, last, password, api_key, role, params, disable) VALUES ('admin@mail.com', 'Admin', 'Adminko', '$2a$12$X6tg2xwDQt9ylBOiorbyd.RF1.SLKtLrtm1SF8uCjnazb5SR9svK.', '2e52721943e85c9c51fc10a7bc57f5b9', 'admin', '', 'N');