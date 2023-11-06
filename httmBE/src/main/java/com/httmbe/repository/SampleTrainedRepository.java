package com.httmbe.repository;

import com.httmbe.model.SampleTrained;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface SampleTrainedRepository extends JpaRepository<SampleTrained, Long> {
    List<SampleTrained> findBysampleID(Long sampleId);
}
