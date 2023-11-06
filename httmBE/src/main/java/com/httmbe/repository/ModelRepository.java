package com.httmbe.repository;

import com.httmbe.model.Model;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

@Repository
public interface ModelRepository extends JpaRepository<Model, Long> {
    @Query("SELECT MAX(t.id) FROM Model t")
    int findMaxID();

}
