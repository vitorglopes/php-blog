use blog;

INSERT INTO categories (description) VALUES 
('Geral'), ('Ciência'), ('Tecnologia'), ('Saúde'), ('Negócios'),
('Economia e Finanças'),('Estilo de Vida'), ('Política');

INSERT INTO users (first_name, last_name, email, passwd, active, last_login) VALUES 
('Vitor', 'Lopes', 'vitorlopeson@gmail.com', '123456', 1, null);

INSERT INTO posts (user_id, category_id, views, title, subtitle, content, registered_at) VALUES 
(1, 1, 0, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'At vero eos et acusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distintatio, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus aut officiis debitis aut rerum necessitatibus saepe eveniet. ut et voluptates repudiandae sint et molestiae non recusandae Itaque earum. rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', CURRENT_TIMESTAMP());

INSERT INTO posts (user_id, category_id, views, title, subtitle, content, registered_at)
VALUES(1, 2, 0, 'Publicacao 02', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'At vero eos et acusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distintatio, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus aut officiis debitis aut rerum necessitatibus saepe eveniet. ut et voluptates repudiandae sint et molestiae non recusandae Itaque earum. rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', CURRENT_TIMESTAMP());

INSERT INTO posts (user_id, category_id, views, title, subtitle, content, registered_at)
VALUES(1, 3, 0, 'Publicacao 03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'At vero eos et acusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distintatio, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus aut officiis debitis aut rerum necessitatibus saepe eveniet. ut et voluptates repudiandae sint et molestiae non recusandae Itaque earum. rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', CURRENT_TIMESTAMP());

INSERT INTO comments (ref_comment_id, post_id, user_id, content, registered_at) VALUES 
(0, 1, 1, 'Esse é o primeiro comentário!', CURRENT_TIMESTAMP());

INSERT INTO comments (ref_comment_id, post_id, user_id, content, registered_at) VALUES 
(1, 1, 1, 'Resposta ao primeiro comentário', CURRENT_TIMESTAMP());

INSERT INTO comments (ref_comment_id, post_id, user_id, content, registered_at) VALUES 
(1, 1, 1, 'Segundo comentário resposta', CURRENT_TIMESTAMP());
