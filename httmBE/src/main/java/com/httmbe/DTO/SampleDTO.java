package com.httmbe.DTO;

import com.httmbe.model.Model;
import com.httmbe.model.Sample;
import com.httmbe.model.trainedModel;
import java.util.Set;
public class SampleDTO {
    private Sample sample;
    private Model model;
    public SampleDTO(Sample sample, Model model) {
        this.sample = sample;
        this.model = model;
    }

    public Sample getSample() {
        return sample;
    }

    public void setSample(Sample sample) {
        this.sample = sample;
    }

    public Model getModel() {
        return model;
    }

    public void setModel(Model model) {
        this.model = model;
    }
}
