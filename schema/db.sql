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

DROP TABLE IF EXISTS articles;
CREATE TABLE articles (
  id SERIAL,
  title varchar(255),
  content text,
  meta_title varchar(255),
  meta_description varchar(255),
  meta_keywords varchar(255),
  author int,
  date_created varchar(10) default to_char(CURRENT_DATE, 'yyyy-mm-dd'),
  cover varchar(255),
  blog varchar(1) DEFAULT 'N',
  disable varchar(1) DEFAULT 'Y',
  PRIMARY KEY (id)
);

INSERT INTO articles (title, content, meta_title, meta_description, meta_keywords, author, date_created, cover, blog, disable) VALUES ('This is simple blog article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum turpis lorem, porta vitae justo et, maximus sagittis felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut bibendum lacus eu egestas faucibus. Proin lacus lectus, hendrerit sed faucibus ut, viverra quis sem. Praesent sagittis porttitor suscipit. Mauris enim eros, vehicula sed massa sit amet, convallis ultricies turpis. Mauris euismod neque et odio hendrerit efficitur. Morbi et accumsan lacus. Proin dolor enim, congue at nisl et, blandit sollicitudin sem. Fusce condimentum venenatis rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum gravida purus a eleifend maximus. Phasellus rutrum, justo a finibus rhoncus, nibh massa aliquam arcu, non aliquet lacus nulla eget lacus. Nulla pharetra vel augue eget tincidunt. Etiam ultrices tempor lobortis.

Sed erat risus, interdum ac pellentesque id, convallis ac tortor. Aenean imperdiet turpis nec porttitor laoreet. Maecenas blandit consequat ex, eget facilisis nibh rutrum ac. Aenean at dui condimentum, lacinia purus vitae, egestas mauris. Donec at volutpat neque. Phasellus suscipit tincidunt ipsum, quis commodo lacus dictum et. Integer cursus tincidunt dictum. Sed aliquam placerat dui id bibendum. Cras quis lorem sit amet quam venenatis consectetur quis vel nisl. Fusce semper arcu est, ut sollicitudin est commodo ut. Morbi tellus sapien, tempus sed faucibus eget, posuere quis enim. Vivamus euismod nisl dapibus, ultricies risus a, blandit libero. Nulla sed commodo dolor.

Aenean faucibus vulputate leo, ac vulputate odio placerat sit amet. In suscipit, massa ac sodales imperdiet, sapien libero maximus est, quis fringilla leo diam ut nisi. Nunc gravida diam vel ex pulvinar tincidunt. Nulla enim est, tincidunt et lectus vitae, tempor venenatis ipsum. Fusce sed lectus sit amet erat aliquam pulvinar quis ac enim. Praesent at ultricies est, eget dictum dolor. Nunc aliquam metus vel diam mollis, quis malesuada mauris viverra. In feugiat non lorem eleifend vulputate. Nullam vulputate, sapien ut ultrices posuere, felis elit imperdiet elit, id congue nibh nunc quis dui. Curabitur porttitor tortor bibendum, ultrices libero consequat, viverra nibh. Integer bibendum maximus tincidunt. Phasellus mattis eros sodales tortor consequat maximus. Pellentesque molestie varius sem, sed imperdiet nulla facilisis eu. Aenean pulvinar magna vitae mi hendrerit sodales. Proin dignissim quis mauris eu efficitur. Sed leo metus, condimentum et blandit sed, posuere a ex.

Donec nec magna sem. Sed et felis diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque ut accumsan justo, et sollicitudin nulla. Proin maximus orci orci, at consequat ipsum cursus a. Sed vel sapien arcu. Curabitur tristique dignissim scelerisque. Phasellus nec fringilla lectus. Sed posuere eget ante non eleifend. Sed suscipit libero id erat eleifend tincidunt. Suspendisse pharetra sollicitudin diam, pretium tempor quam. Vestibulum ut vulputate magna, nec cursus nibh. Aenean sodales massa ut quam iaculis iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eleifend turpis at cursus ultrices.

Donec id euismod lorem, a bibendum eros. Vestibulum consequat pulvinar porta. Nullam convallis quam sit amet efficitur aliquet. Proin sed finibus massa. Phasellus diam turpis, eleifend at dolor sit amet, sodales hendrerit dui. Nam ut imperdiet lacus. Curabitur aliquam enim sapien, vitae viverra arcu cursus sed. Vestibulum vehicula auctor felis nec vehicula. Aenean a eros vel augue maximus facilisis. Suspendisse porta pretium erat, vel sodales ante eleifend quis. Pellentesque commodo vulputate quam, gravida accumsan lorem hendrerit at. Suspendisse viverra, ipsum et hendrerit interdum, ante leo efficitur odio, quis maximus lacus risus non eros. Maecenas pharetra arcu diam. Aenean viverra mauris ipsum.', '', '', '', 1, '', '', 'Y', 'N');