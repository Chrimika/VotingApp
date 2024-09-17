<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #d8d1bd; color: black; font-size: 15px; font-family: Times">
            <div class="modal-header">
                <button type="button" class="btn btn-close btn-curve pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Add New Voter</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_add.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="candidate_select" class="col-sm-3 control-label">Candidate</label>
                        <div class="col-sm-9">
                            <!-- <select class="form-control" id="candidate_select" name="candidate" required>
                                <option value="">Select Candidate</option>
                                <option value="OLINGA Francis Bertin (PPM-A)">OLINGA Francis Bertin (PPM-A)</option>
                                <option value="SCHOUEL MAVIANE Dominique (Magistrature)">SCHOUEL MAVIANE Dominique (Magistrature)</option>
                                <option value="NGASHILI NTALIPOUO Claude (Douane A)">NGASHILI NTALIPOUO Claude (Douane A)</option>
                                <option value="ALINDA Pierre (Trésor A)">ALINDA Pierre (Trésor A)</option>
                                <option value="AMUNGWA BODANG Martine (Douane A)">AMUNGWA BODANG Martine (Douane A)</option>
                                <option value="DZOU Bernard Fils (Douane B)">DZOU Bernard Fils (Douane B)</option>
                                <option value="ALOBWEDE Bertrand (Trésor A)">ALOBWEDE Bertrand (Trésor A)</option>
                                <option value="NTOCKE NTOCKE Hermann (Travail B)">NTOCKE NTOCKE Hermann (Travail B)</option>
                                <option value="PEMBOURAH Seid (AG-A)">PEMBOURAH Seid (AG-A)</option>
                                <option value="EBALLE Nancy Esther (AG-B)">EBALLE Nancy Esther (AG-B)</option>
                                <option value="OKALA TSIMI Jean Michel (Trésor B)">OKALA TSIMI Jean Michel (Trésor B)</option>
                                <option value="EMANGA NDJABA Alex Fred (AH)">EMANGA NDJABA Alex Fred (AH)</option>
                                <option value="MOHAMADOU MOUKTAR (Travail B)">MOHAMADOU MOUKTAR (Travail B)</option>
                                <option value="ZOE OWONO KOUMA Maurice (Greffes A)">ZOE OWONO KOUMA Maurice (Greffes A)</option>
                                <option value="AMINA SEIBOU Angèle Désirée (Impôts B)">AMINA SEIBOU Angèle Désirée (Impôts B)</option>
                                <option value="EPOH MBAPPE Ardant (Douane A)">EPOH MBAPPE Ardant (Douane A)</option>
                                <option value="ESSOMBA Olivia (PPM-B)">ESSOMBA Olivia (PPM-B)</option>
                                <option value="LONGUE Marilyn Huguette (AH)">LONGUE Marilyn Huguette (AH)</option>
                                <option value="MBOTE Franck (Greffes B)">MBOTE Franck (Greffes B)</option>
                                <option value="MBIA Berthe Angèle (Magistrature)">MBIA Berthe Angèle (Magistrature)</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="votes" class="col-sm-3 control-label">Number of Votes</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="votes" name="votes" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-curve pull-left" style='background-color: #FFDEAD; color: black; font-size: 12px; font-family: Times' data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-curve" style='background-color: #9CD095; color: black; font-size: 12px; font-family: Times' name="add"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>
