package com.httmbe.DTO.response;

import com.httmbe.model.Model;
import com.httmbe.model.Sample;
import com.httmbe.model.trainedModel;
import lombok.Data;

import java.util.ArrayList;
import java.util.List;

@Data
public class DetailModelDTO {
    private Model model;
    private List<Sample> samples = new ArrayList<>();
    private List<trainedModel> trainedModels = new ArrayList<>();

    public void addTrainedModel(trainedModel trainedModel) {
        trainedModels.add(trainedModel);
    }
}
