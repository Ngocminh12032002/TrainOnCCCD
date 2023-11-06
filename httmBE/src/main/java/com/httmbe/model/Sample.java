package com.httmbe.model;

import jakarta.persistence.*;

import java.util.Set;

@Entity
@Table(name = "sample")
public class Sample {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @Column
    private String name;

    @Column
    private String path;

    @Column
    private long modelID;

    @Column
    private String pathLabel;

    public Sample() {
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPath() {
        return path;
    }

    public void setPath(String path) {
        this.path = path;
    }

    public long getModelID() {
        return modelID;
    }

    public void setModelID(long modelID) {
        this.modelID = modelID;
    }

    public String getPathLabel() {
        return pathLabel;
    }

    public void setPathLabel(String pathLabel) {
        this.pathLabel = pathLabel;
    }
}
