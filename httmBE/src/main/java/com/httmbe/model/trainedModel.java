package com.httmbe.model;

import jakarta.persistence.*;
import lombok.Data;

import java.util.Set;

@Entity
@Data
@Table(name = "trainedmodel")
public class trainedModel {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long id;

    @Column
    private double box;

    @Column
    private double cls;

    @Column
    private int epoch;

    @Column
    private double total;

    @Column
    private double obj;

    @Column
    private long modelID;

}
