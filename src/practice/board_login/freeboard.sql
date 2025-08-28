-- freeboard database를 사용
USE freeboard;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 사용자 고유 ID
    username VARCHAR(50) NOT NULL UNIQUE, -- 로그인ID
    name VARCHAR(100) NOT NULL,         -- 사용자 닉네임
    pw VARCHAR(100) NOT NULL            -- 해시된 비밀번호
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 생성
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- 게시글 고유ID
    userid INT NOT NULL,          -- 작성자ID
    title VARCHAR(255) NOT NULL,         -- 제목
    name VARCHAR(100) NOT NULL,          -- 
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_user FOREIGN KEY (userid)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



