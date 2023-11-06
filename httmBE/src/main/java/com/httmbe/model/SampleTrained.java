package com.httmbe.model;

import jakarta.persistence.*;

@Entity
@Table(name = "sampletrained")
public class SampleTrained {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @Column
    private int sampleID;

    @Column int trainedID;

    public SampleTrained() {
    }

    public SampleTrained(long id, int sampleID, int trainedID) {
        this.id = id;
        this.sampleID = sampleID;
        this.trainedID = trainedID;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public int getSampleID() {
        return sampleID;
    }

    public void setSampleID(int sampleID) {
        this.sampleID = sampleID;
    }

    public int getTrainedID() {
        return trainedID;
    }

    public void setTrainedID(int trainedID) {
        this.trainedID = trainedID;
    }
}
