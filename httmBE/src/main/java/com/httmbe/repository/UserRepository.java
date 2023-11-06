package com.httmbe.repository;

import com.httmbe.model.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface UserRepository extends JpaRepository<User, Long> {
    @Query("SELECT i from User i WHERE i.username = :username AND i.password = :password")
    Optional<User> login(@Param("username") String username, @Param("password") String password);
}
