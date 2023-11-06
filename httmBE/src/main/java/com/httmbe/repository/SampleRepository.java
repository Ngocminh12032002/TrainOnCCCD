package com.httmbe.repository;

import com.httmbe.model.Sample;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface SampleRepository extends JpaRepository<Sample, Long> {
    @Query("SELECT new com.httmbe.DTO.SampleDTO(s,m) FROM Sample s JOIN Model m ON s.modelID = m.id")
    Page<Sample> findAllSamples(Pageable pageable);

    List<Sample> findBymodelID(Long id);
}
