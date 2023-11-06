package com.httmbe.repository;

import com.httmbe.model.Sample;
import com.httmbe.model.trainedModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

@Repository
public interface trainedModelRepository extends JpaRepository<trainedModel, Long> {
    @Query("SELECT MAX(t.id) FROM trainedModel t")
    int findMaxID();
}
